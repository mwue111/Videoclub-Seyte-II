import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';

@Component({
  selector: 'app-change-password-request',
  templateUrl: './change-password-request.component.html',
  styleUrls: ['./change-password-request.component.css']
})
export class ChangePasswordRequestComponent {
  resetForm: FormGroup;
  hasError: boolean = false;
  hasErrorText: any = '';
  hasSuccess!: boolean;
  hasSuccessText: any = '';
  successMsg: any;

  constructor(
    private fb: FormBuilder,
    private _auth: AuthService
    ) {
    this.resetForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
    });
  }
  onSubmit() {
    this.hasError = false;
    this.hasErrorText = '';
    this.hasSuccessText = '';

    this._auth.sendResetPasswordEmail(this.resetForm.value).subscribe(
      (resp: any) => {
        if(resp){
          this.hasError = true;
          this.hasErrorText = 'El email proporcionado no existe.'
        }
        else{
          this.hasSuccess = true;
          this.hasSuccessText = 'Se ha enviado un correo para restablecer la contraseña.';
          // alert(this.successMsg.message)
        }
      },
      (error) => {
        this.hasError = true;
        this.hasErrorText = error.error.message;
      }
    );
  }
}
