import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(
    private auth_service: AuthService,
    private router: Router,
  ) {

  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
      if(!this.auth_service.isLogged()){
        this.router.navigate(['auth/login']);
        return false;
      }

      let token = this.auth_service.token;
      let expired = (JSON.parse(atob(token.split('.')[1]))).exp;

      if(Math.floor((new Date).getTime() / 1000) >= expired){
        this.auth_service.logout();
        return false;
      }

    return true;
  }

}
