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

//videogular:
import {VgCoreModule} from '@videogular/ngx-videogular/core';
import {VgControlsModule} from '@videogular/ngx-videogular/controls';
import {VgOverlayPlayModule} from '@videogular/ngx-videogular/overlay-play';
import {VgBufferingModule} from '@videogular/ngx-videogular/buffering';
import { VideogularComponent } from './videogular/videogular.component';
// import {SingleMediaPlayer} from './single-media-player';


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
  ],
  exports: [
    material,
    RouterModule,
    VideogularComponent,
  ],
  providers: [appRoutingProviders, { provide: HTTP_INTERCEPTORS, useClass: LoadingInterceptor, multi: true }],
  bootstrap: [
    AppComponent,
    // SingleMediaPlayer
 ],
})
export class AppModule {}
