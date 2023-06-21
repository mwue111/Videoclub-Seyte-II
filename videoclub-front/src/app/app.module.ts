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
import { CommentsModule } from './modules/comments/comments.module';
import { ViewMovieComponent } from './view-movie/view-movie.component';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

//videogular:
import {VgCoreModule} from '@videogular/ngx-videogular/core';
import {VgControlsModule} from '@videogular/ngx-videogular/controls';
import {VgOverlayPlayModule} from '@videogular/ngx-videogular/overlay-play';
import {VgBufferingModule} from '@videogular/ngx-videogular/buffering';
import { VideogularComponent } from './videogular/videogular.component';

import { UserPageComponent } from './user-page/user-page.component';
import { DragDirective } from './directives/drag.directive';
import { SearchModule } from './modules/search/search.module';
import { PopupComponent } from './modals/popup/popup.component';

//tests modal
import { MatDialogModule } from '@angular/material/dialog';

//payment
import { NgxPayPalModule } from 'ngx-paypal';
import { DaysToPipe } from './pipes/days-to.pipe';
import { PremiumFormComponent } from './modals/premium-form/premium-form.component';

//Aquí: https://www.youtube.com/watch?v=9BrcahgymVw&list=PL4bT56Uw3S4xtlptHVrl6s-lB7qCTfrc2&index=9
//ngx spinner
// import { NgxSpinnerModule } from 'ngx-spinner';

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
    ViewMovieComponent,
    VideogularComponent,
    UserPageComponent,
    DragDirective,
    PopupComponent,
    DaysToPipe,
    PremiumFormComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    routing,
    HttpClientModule,
    BrowserAnimationsModule,
    material,
    CommentsModule,
    VgCoreModule,
    VgControlsModule,
    VgOverlayPlayModule,
    VgBufferingModule,
    FormsModule,
    ReactiveFormsModule,
    SearchModule,
    MatDialogModule,
    NgxPayPalModule,
    // NgxSpinnerModule,
  ],
  exports: [
    material,
    RouterModule,
    VideogularComponent,
  ],
  providers: [appRoutingProviders, { provide: HTTP_INTERCEPTORS, useClass: LoadingInterceptor, multi: true }],
  bootstrap: [AppComponent,],
})
export class AppModule {}
