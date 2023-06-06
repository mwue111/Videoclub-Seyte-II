import { Component, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { Router } from '@angular/router';
import { SearchSharedServiceService } from 'src/app/services/search-shared-service.service';
import { SearchService } from '../../_services/search.service';
import { GenresService } from 'src/app/services/genres.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css'],
})
export class SearchComponent {
  submitted: any = '';
  inputSearch = new FormControl('');
  value: string = '';
  suggestedMovies: any = [];
  suggestedGenres: any = [];
  suggestedMovieGenres: any = [];
  input: string = '';
  genres: any = [];

  constructor(
    private router: Router,
    private _shared: SearchSharedServiceService,
    private _search: SearchService,
    private _genres: GenresService,
  ) {
    this._genres.getAllGenres().subscribe((genres: any) => {
      this.genres = genres;
    })
  }

  ngOnInit() {
    this._shared.query$.subscribe(receivedQuery =>
      this.value = receivedQuery
    )
  }

  onChange(): void {
    this.inputSearch.valueChanges.pipe(
      debounceTime(500),                      //espera 350ms para enviar la petición
      // distinctUntilChanged(),                 //verifica que el valor a emitir no es igual al ya emitido
      filter((search:any) => search !== ''),  //se asegura que no llegue un string vacío
      tap((res: any) => {
        this.submitted = res;
      })
    ).subscribe();
  }

  onSearch(): void {
    this.router.navigate(['/results'], {queryParams: {search: this.submitted}});
  }

  getSuggestions(event: any) {
    this.suggestedMovies = [];
    this.suggestedGenres = [];
    this.suggestedMovieGenres = [];

    console.log('comprobando que los arrays estén vacíos: ', this.suggestedMovies, ' - ', this.suggestedGenres);
    console.log('comprobando que géneros tenga valores: ', this.genres);

    this.input = event.target.value;

    console.log('this.input: ', this.input);

    this._search.suggestions(this.input).then((res:any) => {
      console.log('respuesta que llega: ', res);
      Object.values(res).map((sug: any) => {
        if(this.checkString(sug)){
          this.suggestedMovies.push(sug);
        }
        else{
          this.suggestedMovieGenres.push(sug);
        }
      })
      console.log('Qué tiene suggestedMovies: ', this.suggestedMovies);
      console.log('Qué tiene suggestedMovieGenres: ', this.suggestedMovieGenres);

      for(let i = 0; i < this.genres.length; i++){
        if(this.genres[i].name.toLowerCase().includes(this.input)){
          this.suggestedGenres.push(this.genres[i].name);
        }
      }

      console.log('Qué tiene suggestedGenres: ', this.suggestedGenres);
    })
  }

  checkString(item: any) {
    return item.title.toString().toLowerCase().includes(this.input) ||
          item.director.toString().toLowerCase().includes(this.input) ||
          item.year.toString().toLowerCase().includes(this.input);
  }

  onSuggestedClick(genre: any) {
    console.log('click', genre);
    this.router.navigate(['/results'], {queryParams: {search: genre}})
  }
}
