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
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FooterComponent } from './footer/footer.component';
import { ContactComponent } from './contact/contact.component';
import { FaqsComponent } from './faqs/faqs.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { NavbarComponent } from './navbar/navbar.component';
import { MatToolbarModule } from '@angular/material/toolbar';
import { SpinnerComponent } from './spinner/spinner.component';
import { LoadingInterceptor } from './loading.interceptor';
import { MovieComponent } from './movie/movie.component';
// import { CommentsComponent } from './modules/comments/components/comments/comments.component';
import { CommentsModule } from './modules/comments/comments.module';
// import { DateAgoPipe } from './pipes/date-ago.pipe';


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
    SpinnerComponent,
    MovieComponent,
    // DateAgoPipe,
    // CommentsComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    routing,
    HttpClientModule,
    BrowserAnimationsModule,
    material,
    CommentsModule
  ],
  exports: [material, RouterModule],
  providers: [appRoutingProviders, { provide: HTTP_INTERCEPTORS, useClass: LoadingInterceptor, multi: true }],
  bootstrap: [AppComponent],
})
export class AppModule {}
