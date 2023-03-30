import { NgModule, ModuleWithProviders } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LandingComponent } from './landing/landing.component';
import { ContactComponent } from './contact/contact.component';
import { FaqsComponent } from './faqs/faqs.component';
import { AboutUsComponent } from './about-us/about-us.component';

const routes: Routes = [
  { path: '', component: LandingComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'faqs', component: FaqsComponent },
  { path: 'nosotros', component: AboutUsComponent },
  { path: 'auth', loadChildren: () => import('./modules/auth/auth.module').then(res => res.AuthModule) },
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<RouterModule> = RouterModule.forRoot(routes);

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
