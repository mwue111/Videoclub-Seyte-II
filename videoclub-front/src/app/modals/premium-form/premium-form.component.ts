import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import Swal from 'sweetalert2';
import { ICreateOrderRequest, IPayPalConfig } from 'ngx-paypal';
import { PAYPAL_CLIENT_ID } from 'src/app/config/config';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-premium-form',
  templateUrl: './premium-form.component.html',
  styleUrls: ['./premium-form.component.css']
})
export class PremiumFormComponent {

  public payPalConfig?: IPayPalConfig;
  premiumSubscription: string = '60';
  date: any = new Date();

  constructor(
    public dialogRef: MatDialogRef<any>,
    @Inject(MAT_DIALOG_DATA) public data: any,
    private _user: UsersService,
    private _auth: AuthService,
  ){}

  ngOnInit(): void {
    //nuevo:
    this.initConfig2();

    //antiguo:
    // this.initConfig();
    this.addOneYear();
  }

  addOneYear() {
    const date = this.date;
    date.setFullYear(date.getFullYear() + 1);
    this.date = date.toLocaleDateString('es-ES');
  }

  //############################################################
  //Aquí: https://stackoverflow.com/questions/63201776/paypal-subscription-integration-and-revise-subscription-issues
  //github: https://github.com/prettydev/ngx-paypal-subscription/blob/master/src/app/plan-list/plan-list.component.ts

  private initConfig2(): void {
    this.payPalConfig = {
      // fundingSource: [
      //   // {{ fundingSources,list }}
      // ],
      style: {
        layout: 'vertical',
        shape: 'rect',
        color: 'gold',
        // color: (fundingSource==paypal.FUNDING.PAYLATER) ? 'gold' : '',
      },
      currency: "USD",
      clientId: "<test>",

      createOrderOnServer: async (data) => {
        const response = await fetch("http://localhost:9597/orders/", {
          method: "POST",
        });
        const details = await response.json();
        return details.id;
      },

      createSubscription: (data: any, actions: any) => {
        return actions.subscription.create({
          plan_id: "P-3RX065706M3469222L5IFM4I",
        });
      },

      authorizeOnServer: async (approveData, actions) => {
        const response = await fetch(
          `http://localhost:9597/orders/${approveData.orderID}/capture`,
          {
            method: "POST",
          }
        );
        const details = await response.json();
        // Three cases to handle:
        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
        //   (2) Other non-recoverable errors -> Show a failure message
        //   (3) Successful transaction -> Show confirmation or thank you

        // This example reads a v2/checkout/orders capture response, propagated from the server
        // You could use a different API or structure for your 'orderData'

        const errorDetail = Array.isArray(details.details) && details.details[0];
        if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
          return actions.restart(); // Recoverable state, per:
          // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
        }

        if (errorDetail) {
          let msg = 'Sorry, your transaction could not be processed.';
          if (errorDetail.description) msg += '' + errorDetail.description;
          if (details.debug_id) msg += ' (' + details.debug_id + ')';
          return alert(msg); // Show a failure message (try to avoid alerts in production environments)
        }

        // Successful capture! For demo purposes:
        console.log('Capture result', details, JSON.stringify(details, null, 2));
        const transaction = details.purchase_units[0].payments.captures[0];
        alert('Transaction '+ transaction.status + ': ' + transaction.id + 'See console for all available details');
      },

      onCancel: (data, actions) => {
        console.log("OnCancel", data, actions);
      },
      onError: (err) => {
        console.log("OnError", err);
      },
      onClick: (data, actions) => {
        console.log("onClick", data, actions);
      },
    };
  }

  //############################################################

  private initConfig(): void {
    this.payPalConfig = {
      currency: 'EUR',
      clientId: PAYPAL_CLIENT_ID,
      createOrderOnClient: (res) => <ICreateOrderRequest>{
        intent: 'CAPTURE',
        purchase_units: [{
          amount: {
            currency_code: 'EUR',
            value: this.premiumSubscription,
            breakdown: {
              item_total: {
                currency_code: 'EUR',
                value: this.premiumSubscription
              }
            }
          },
          items: [{
            name: 'Subscripción anual premium',
            quantity: '1',
            category: 'DIGITAL_GOODS',
            unit_amount: {
              currency_code: 'EUR',
              value: this.premiumSubscription,
            },
          }]
        }]
      },
      advanced: {
        commit: 'true'
      },
      style: {
        label: 'paypal',
        layout: 'vertical'
      },
      onApprove: (res, actions) => {
        console.log('onApprove - transaction was approved, but not authorized', res, actions);
        actions.order.get().then((details: any) => {
          console.log('onApprove - you can get full order details inside onApprove: ', details);
        });
      },
      onClientAuthorization: (res) => {
        console.log('onClientAuthorization - you should probably inform your server about completed transaction at this point', JSON.stringify(res));
        this.addToPremiums();
        this.closeDialog();
      },
      onCancel: (res, actions) => {
        console.log('OnCancel', res, actions);
      },
      onError: err => {
        console.log('OnError', err);
      },
      onClick: (res, actions) => {
        console.log('onClick', res, actions);
      }
    }
  }

  addToPremiums() {
    console.log('añadido usuario ', this.data.user, ' a la tabla de premiums');
    this._user.goPremium(this._auth.token, this.data.user).subscribe((res: any) => {
      console.log('res: ', res);
      Swal.fire({
        icon: 'success',
        title:'¡Enhorabuena! ¡Ya eres Premium!',
        text: `¡Disfruta de todas las películas de manera ilimitada hasta el ${this.date}!`,
        confirmButtonColor: '#1874BA'
      }).then(res => {
        if(res.isConfirmed){
          window.location.reload();
        }
      })
    })
  }

  closeDialog(): void {
    this.dialogRef.close();
  }

}
