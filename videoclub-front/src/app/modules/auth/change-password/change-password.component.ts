import { Component} from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';
import { ActivatedRoute } from '@angular/router';
import { throwError } from 'rxjs';

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})
export class ChangePasswordComponent{
  changePasswordForm: FormGroup;
  errors: any;
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
      alert('Las contraseñas no coinciden');
      return;
    }
    if (this.changePasswordForm.value.password.length < 8) {
      alert('La contraseña debe tener al menos 8 caracteres');
      return;
    }
    this._auth.resetPassword(this.changePasswordForm.value).subscribe(
      (result) => {
        alert('Contraseña cambiada correctamente');
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
    } else {
      errorMsg = `Error Code: ${error.status},  Message: ${error.message}`;
    }
    console.log(errorMsg);
    return throwError(() => {
      errorMsg;
    });
  }
}
