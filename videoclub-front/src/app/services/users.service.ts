import { Injectable } from '@angular/core';
import { URL_BACKEND } from '../config/config';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  public url: string;

  constructor() {
    this.url = URL_BACKEND; //en lugar de Global
  }

  getUser(id: number){

  }

  editUser(id: number){

  }

  deleteUser(id: number){

  }
}
