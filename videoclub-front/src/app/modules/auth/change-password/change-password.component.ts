import { Component} from '@angular/core';
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
  errors: any;
  router!: Router;
  hasError: any;
  hasErrorText: any;
  constructor(private fb: FormBuilder, private _auth: AuthService, private route: ActivatedRoute) {
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
    if (this.changePasswordForm.value.password_confirmation !== this.changePasswordForm.value.password) {
      this.hasError = true;
      this.hasErrorText = 'Las contraseñas no coinciden.';
      return;
    }
    if (this.changePasswordForm.value.password.length < 8) {
      this.hasError = true;
      this.hasErrorText = 'La contraseña debe tener más de 8 caracteres.';
      return;
    }
    this._auth.resetPassword(this.changePasswordForm.value).subscribe(
      (result) => {
        alert('Contraseña cambiada correctamente');
        this.router.navigate(['auth/login']);
        this.changePasswordForm.reset();
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
      this.hasError = true;
      this.hasErrorText = 'Ha ocurrido un error al cambiar la contraseña, revise los datos introducidos.';
    } else {
      errorMsg = `Error Code: ${error.status},  Message: ${error.message}`;
      this.hasError = true;
      this.hasErrorText = 'Ha ocurrido un error al cambiar la contraseña, revise los datos introducidos.';
    }
    console.log(errorMsg);
    return throwError(() => {
      errorMsg;
    });
  }
}
