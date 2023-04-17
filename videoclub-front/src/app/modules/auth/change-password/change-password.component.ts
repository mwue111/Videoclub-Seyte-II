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


  constructor(
    private fb: FormBuilder,
    private _auth: AuthService,
    private route: ActivatedRoute,
    private router: Router,
    ) {
    this.changePasswordForm = this.fb.group({
      email: [''],
      password: [''],
      password_confirmation: [''],
      passwordToken: ['']
    });
    route.queryParams.subscribe(params => {
      this.changePasswordForm.controls['passwordToken'].setValue(params['token']);
    });
  }

  onSubmit() {
    this.hasError = false;
    this.hasErrorText = '';
    this.hasSuccessText = '';

    if (this.changePasswordForm.value.password_confirmation !== this.changePasswordForm.value.password) {
      // alert('Las contraseñas no coinciden');
      this.hasError = true;
      this.hasErrorText = "Las contraseñas no coinciden."
      return;
    }
    if (this.changePasswordForm.value.password.length < 8) {
      // alert('La contraseña debe tener al menos 8 caracteres');
      this.hasError = true;
      this.hasErrorText = "La contraseña debe tener al menos 8 caracteres.";
      return;
    }
    this._auth.resetPassword(this.changePasswordForm.value).subscribe(
      (result: any) => {
        // alert('Contraseña cambiada correctamente');
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
    let errorMsg = '';
    if (error.error instanceof ErrorEvent) {
      errorMsg = `Error: ${error.error.message}`;
      console.log('errorMsg: ', errorMsg);
      this.hasError = true;
      this.hasErrorText = 'Ha ocurrido un error al cambiar la contraseña, revise los datos introducidos.';
    } else {
      this.hasError = true;
      this.hasErrorText = 'Ha ocurrido un error al cambiar la contraseña, revise los datos introducidos.';
      errorMsg = `Error Code: ${error.status},  Message: ${error.message}`;
    }
    console.log(errorMsg);
    return throwError(() => {
      errorMsg;
    });
  }
}
