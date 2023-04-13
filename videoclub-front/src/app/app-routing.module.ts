import { NgModule, ModuleWithProviders } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LandingComponent } from './landing/landing.component';
import { ContactComponent } from './contact/contact.component';
import { FaqsComponent } from './faqs/faqs.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { NavbarComponent } from './navbar/navbar.component';
import { AuthGuard } from './modules/auth/_services/auth.guard';

const routes: Routes = [
  { path: '', component: LandingComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'faqs', component: FaqsComponent },
  { path: 'nosotros', component: AboutUsComponent },
  {
    path: 'auth',
    loadChildren: () =>
      import('./modules/auth/auth.module').then((res) => res.AuthModule),
  },
  { path: 'welcome', canActivate: [AuthGuard], loadChildren: () =>
      import('./modules/user-landing/user-landing.module')
            .then(res => res.UserLandingModule)  },
  { path: '**', redirectTo: 'error/404' },
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<RouterModule> =
  RouterModule.forRoot(routes);

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
