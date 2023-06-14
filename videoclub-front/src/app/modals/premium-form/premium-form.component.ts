import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import Swal from 'sweetalert2';
// import { ICreateOrderRequest, IPayPalConfig } from 'ngx-paypal';
import {
  PayPalScriptService,
  IPayPalConfig,
  NgxPaypalComponent,
} from "ngx-paypal";
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
  private plans: any = []; //nuevo
  public configs: any = {} //nuevo

  constructor(
    public dialogRef: MatDialogRef<any>,
    @Inject(MAT_DIALOG_DATA) public data: any,
    private _user: UsersService,
    private _auth: AuthService,
    private payPalScriptService: PayPalScriptService  //nuevo
  ){}

  ngOnInit(): void {
    //nuevo:
    this.plans.map((plan: any) => {
      this.configs[plan.name] = this.getConfig(plan.id);
    });

    //antiguo:
    // this.initConfig();
    this.addOneYear();
  }

  addOneYear() {
    this.date = this.date.setFullYear(this.date.getFullYear() + 1);
    console.log('año: ', new Date(this.date));
  }

  //############################################################
  //Aquí: https://stackoverflow.com/questions/63201776/paypal-subscription-integration-and-revise-subscription-issues
  //github: https://github.com/prettydev/ngx-paypal-subscription/blob/master/src/app/plan-list/plan-list.component.ts
  getConfig(plan_id: any): IPayPalConfig {
    return {
      clientId: PAYPAL_CLIENT_ID,
      currency: "EUR",
      vault: "true",
      style: {
        label: "paypal",
        layout: "vertical",
        // size: "small",
        shape: "pill",
        color: "silver",
        tagline: false,
      },
      //el error lo da por IPayPalConfig
      createSubscription: function (data: any, actions: any) {
        return actions.subscription.create({
          plan_id,
        });
      },

      onApprove: function (data, actions) {
        console.log("subscription data:", data);
        actions.subscription.get().then((details: any) => {
          console.log("subscription details:", details);
          alert("Success to subscribe!");
        });
      },

      onCancel: (data, actions) => {
        console.log("OnCancel", data, actions);
      },

      onError: (err) => {
        console.log("OnError", err);
      },

      onClick: (data, actions) => {
        console.log("Clicked:", data, actions);
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
        text: `Disfruta de todas las películas de manera ilimitada hasta el ${this.date}`,
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
