import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';
import {
  AppRoutingModule,
  appRoutingProviders,
  routing,
} from './app-routing.module';
import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FooterComponent } from './footer/footer.component';
import { ContactComponent } from './contact/contact.component';
import { FaqsComponent } from './faqs/faqs.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { NavbarComponent } from './navbar/navbar.component';
import { MatToolbarModule } from '@angular/material/toolbar';
import { RecoverPasswordComponent } from './recover-password/recover-password.component';
import { ChangePasswordRequestComponent } from './components/change-password-request/change-password-request.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ChangePasswordComponent } from './components/change-password/change-password.component';

const material = [MatToolbarModule];

@NgModule({
  declarations: [
    AppComponent,
    LandingComponent,
    FooterComponent,
    ContactComponent,
    FaqsComponent,
    AboutUsComponent,
    NavbarComponent,
    RecoverPasswordComponent,
    ChangePasswordRequestComponent,
    ChangePasswordComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    routing,
    HttpClientModule,
    BrowserAnimationsModule,
    material,
    FormsModule,
    ReactiveFormsModule,
  ],
  exports: [material, RouterModule],
  providers: [appRoutingProviders],
  bootstrap: [AppComponent],
})
export class AppModule {}
