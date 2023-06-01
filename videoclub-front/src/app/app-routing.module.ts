import { NgModule, ModuleWithProviders } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LandingComponent } from './landing/landing.component';
import { ContactComponent } from './contact/contact.component';
import { FaqsComponent } from './faqs/faqs.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { MovieComponent } from './movie/movie.component';
import { ViewMovieComponent } from './view-movie/view-movie.component';
import { UserPageComponent } from './user-page/user-page.component';
import { ResultsComponent } from './modules/search/components/results/results.component';

const routes: Routes = [
  { path: '', component: LandingComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'faqs', component: FaqsComponent },
  { path: 'nosotros', component: AboutUsComponent },
  { path: 'pelicula/:id', component: MovieComponent },
  { path: 'ver-pelicula/:id', component: ViewMovieComponent },
  { path: 'usuario/:id', component: UserPageComponent },
  { path: 'review/:id/:review_id', component: MovieComponent },
  { path: 'results', component: ResultsComponent },
  {
    path: 'auth',
    loadChildren: () =>
      import('./modules/auth/auth.module').then((res) => res.AuthModule),
  },
  { path: '**', redirectTo: 'error/404' },
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<RouterModule> =
  RouterModule.forRoot(routes);

@NgModule({
  imports: [RouterModule.forRoot(routes, {scrollPositionRestoration: 'enabled',
  anchorScrolling: 'enabled',
  scrollOffset: [0, 64]})],
  exports: [RouterModule],
})
export class AppRoutingModule {}
