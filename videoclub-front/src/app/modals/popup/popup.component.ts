import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ICreateOrderRequest, IPayPalConfig } from 'ngx-paypal';
import { PAYPAL_CLIENT_ID } from 'src/app/config/config';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { UsersService } from 'src/app/services/users.service';


@Component({
  selector: 'app-popup',
  templateUrl: './popup.component.html',
  styleUrls: ['./popup.component.css']
})
export class PopupComponent {

  public payPalConfig?: IPayPalConfig;

  constructor(
    public dialogRef: MatDialogRef<any>,
    @Inject(MAT_DIALOG_DATA) public data: any,
    private router: Router,
    private _user: UsersService,
    private _auth: AuthService,
  ) { }

  ngOnInit(): void {
    this.initConfig();
  }

  private initConfig(): void {
    this.payPalConfig = {
      currency: 'EUR',
      clientId: PAYPAL_CLIENT_ID,
      createOrderOnClient: (res) => <ICreateOrderRequest>{
        intent: 'CAPTURE',
        purchase_units: [{
          amount: {
            currency_code: 'EUR',
            value: this.data.movie.price,
            breakdown: {
              item_total: {
                currency_code: 'EUR',
                value: this.data.movie.price
              }
            }
          },
          items: [{
            name: this.data.movie.title,
            quantity: '1',
            category: 'DIGITAL_GOODS',
            unit_amount: {
              currency_code: 'EUR',
              value: this.data.movie.price,
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
        this.addToRents(this.data.movie.id);
        this.closeDialog();
        this.router.navigate(['/ver-pelicula', this.data.movie.id]);
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
    };
  }

  addToRents(id: number) {
    console.log('añadida película de id ', id, ' a alquiladas');
    this._user.createRent(this._auth.token, this.data.user.id, id).subscribe((res: any) => {
      console.log('res: ', res);
    })
  }

  closeDialog(): void {
    this.dialogRef.close();
  }
}
