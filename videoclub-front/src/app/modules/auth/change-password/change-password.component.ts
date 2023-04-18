import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';
import { throwError } from 'rxjs';

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})
export class ChangePasswordComponent{
  changePasswordForm: FormGroup;
  hasError: Boolean = false;
  hasErrorText: any = '';
  hasSuccess!: Boolean;
  hasSuccessText: any = '';
  passCount: number = 0;

  constructor(
    private fb: FormBuilder,
    private _auth: AuthService,
    private route: ActivatedRoute,
    private router: Router,
    ) {
    this.changePasswordForm = this.fb.group({
      email: [
        '',
        [Validators.required, Validators.email,]
      ],
      password: [
        '',
        [Validators.required, Validators.minLength(8), Validators.maxLength(100)]
      ],
      password_confirmation: [
        '',
        [Validators.required, Validators.minLength(8), Validators.maxLength(100)]
      ],
      passwordToken: ['']
    });
    route.queryParams.subscribe(params => {
      this.changePasswordForm.controls['passwordToken'].setValue(params['token']);
    });
  }

  onChange(passLength: number) {
    this.hasError = false;
    this.hasErrorText = '';

    if(passLength < 8){
      this.hasError = true;
      this.hasErrorText = 'La contraseña debe tener al menos 8 caracteres.'
    }
    if(passLength >= 8){
      this.verifyNewPassword(this.changePasswordForm.value.email, this.changePasswordForm.value.password);
    }
  }

  verifyPassword(password: string, password_confirmation: string) {
    return password !== password_confirmation;
  }

  verifyNewPassword(email: string, password: string) {

    this._auth.verifyOldPass(email, password)
              .subscribe((res: any) => {
                if(res === 1){
                  this.hasError = true;
                  this.hasErrorText = 'La nueva contraseña no puede ser igual a la antigua contraseña.';
                }
              });
  }


  onSubmit() {
    this.hasError = false;
    this.hasErrorText = '';
    this.hasSuccessText = '';

    this._auth.resetPassword(this.changePasswordForm.value).subscribe(
      (result: any) => {
        this.changePasswordForm.reset();
        this.hasSuccess = true;
        this.hasSuccessText = "La contraseña se ha cambiado correctamente."
        setTimeout(() => {
          this.router.navigate(['auth/login']);
        }, 2000);
      },
      (error) => {
        this.handleError(error);
      }
    );
  }

  handleError(error: any) {
    if(this.verifyPassword(this.changePasswordForm.value.password_confirmation, this.changePasswordForm.value.password)){
      this.hasError = true;
      this.hasErrorText = 'Las contraseñas no coinciden.';
    }
    else{
      this.hasError = true;
      this.hasErrorText = 'Email incorrecto.';
    }
    return throwError(() => {
      error;
    });
  }
}
