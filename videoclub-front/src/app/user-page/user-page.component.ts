import { Component, OnInit } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from '../services/users.service';
import { Observable, map, of, switchMap } from 'rxjs';
import Swal from 'sweetalert2';
import { UserSharedServiceService } from '../services/user-shared-service.service';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent implements OnInit{

  user: any;
  updatedUser: any;
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
    private _shared: UserSharedServiceService,
  ) {
    if(this._auth.isLogged()){
      this.user = this._auth.user.user;
    }
    else{
      this.router.navigate(['auth/login']);
    }
  }

  fetchUser(): Promise<any> {
    return new Promise<void>((resolve, reject) => {
      this._users.getUser(this._auth.token, this.user.id)
              .subscribe((res: any) => {
                this.user = res;
                resolve();
              },
              (error: any) => {
                reject(error);
              }
              );
    });
  }

  async ngOnInit() {
    this._shared.username$.subscribe(username => {
      this.user.username = username
    })

    await this.fetchUser();
    this.initializeForm();
  }

  initializeForm() {
    this.editForm = this.fb.group({
      username: [
        this.user.username,
        Validators.compose([
          // Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      name: [
        this.user.name,
        Validators.compose([
          // Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      surname: [
        this.user.surname,
        Validators.compose([
          // Validators.required,
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

  updateUser(){
    this.isEditing = true;
    this.initializeForm();
  }

  saveChanges(){

    this.verifyPassword(this.user.email, this.editForm.value.password).pipe(
      switchMap((passMatches: boolean) => {
        if(!passMatches) {
          return of(null);
        }
        else{
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

          return this._users.editUser(this._auth.token, this.user.id, this.editForm.value);
        }
      })
    )
    .subscribe((res: any) => {
      console.log('res: ', res);
      if(res){
        if(res.error){
          this.editForm.controls['password'].reset();
          this.hasError = true;
          this.hasErrorText = 'Este nombre de usuario ya está en uso.';
        }
        else{
          this.close();
          this.fetchUser();
          this._shared.updateUsername(res.username);

          Swal.fire({
            icon: 'success',
            title: '¡Tus datos se han actualizado!',
            confirmButtonColor: '#1874BA'
          })
        }
      }
      else{
        this.editForm.controls['password'].reset();
        this.hasError = true;
        this.hasErrorText = 'La contraseña no es correcta.';
      }
    })
  }

  close(){
    this.isEditing = false;
  }
}
