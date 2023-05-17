import { Component, OnInit } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from '../services/users.service';
import { Observable, map, of, switchMap } from 'rxjs';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent implements OnInit{
  user: any;
  isEditing!: boolean;
  editForm!: FormGroup;
  hasError: boolean = false;
  hasErrorText: string = '';

  constructor(
    private _auth: AuthService,
    private router: Router,
    private _users: UsersService,
    private fb: FormBuilder,
    private route: ActivatedRoute,

  ) {
    if(this._auth.isLogged()){
      this.user = this._auth.user.user;
    }
    else{
      this.router.navigate(['auth/login']);
    }

    if(!this.user.username){
      this.user.username = 'Anónimo';
    }

    if(!this.user.name){
      this.user.name = '';
    }

    if(!this.user.surname){
      this.user.surname = '';
    }
  }

  ngOnInit() {
    console.log('usuario: ', this.user);

    this.editForm = this.fb.group({
      username: [
        this.user.username,
        Validators.compose([
          Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      name: [
        this.user.name,
        Validators.compose([
          Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      surname: [
        this.user.surname,
        Validators.compose([
          Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      email: [
        this.user.email,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250)
        ])
      ],
      birth_date: [
        this.user.birth_date,
        Validators.compose([
          Validators.required,
          Validators.pattern(/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/)
        ])
      ],
      password: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ],
      new_pass: [
        null,
        Validators.compose([
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ],
    })
  }

  verifyPassword(email:string, password: string): Observable<boolean>{
    return this._auth.verifyOldPass(email, password).pipe(
      map((res: any) => {
        return res === 1;
      })
    )
  }

  updateUser(user: any){
    this.isEditing = true;
    console.log('editando usuario ', user.id);
  }

  saveChanges(){
    if(this.editForm.value.new_pass){
      const data = {
        'email': this.user.email,
        'password': this.editForm.value.new_pass
      };

      this._users.resetPassword(this._auth.token, data)
                  .subscribe((res: any) => {
                    console.log('respuesta recibida en contraseña: ', res);
                  })
    }

    this.verifyPassword(this.user.email, this.editForm.value.password).pipe(
      switchMap((passMatches: boolean) => {
        if(!passMatches) {
          return of(null);
        }
        else{
          return this._users.editUser(this._auth.token, this.user.id, this.editForm.value);
        }
      })
    )
    .subscribe((res: any) => {
      console.log(res);
      if(res){
        this.user = res;
        this.close();

        Swal.fire({
          icon: 'success',
          title: '¡Tus datos se han actualizado!',
          confirmButtonColor: '#1874BA'
        })

      }
      else{
        this.hasError = true;
        this.hasErrorText = 'La contraseña no es correcta.';
      }
    })
  }

  close(){
    this.isEditing = false;
  }
}
