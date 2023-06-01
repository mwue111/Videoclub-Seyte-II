import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SearchComponent } from './components/search/search.component';
import { ResultsComponent } from './components/results/results.component';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { CardMovieComponent } from './components/card-movie/card-movie.component';



@NgModule({
  declarations: [
    SearchComponent,
    ResultsComponent,
    CardMovieComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  exports: [
    SearchComponent,
    ResultsComponent,
  ]
})
export class SearchModule { }
