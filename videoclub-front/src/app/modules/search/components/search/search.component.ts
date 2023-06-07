import { Component, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { NavigationExtras, Router } from '@angular/router';
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
  suggestedDireccion: any = [];
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
      distinctUntilChanged(),                 //verifica que el valor a emitir no es igual al ya emitido
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
    this.suggestedDireccion = [];

    this.input = event.target.value;

    this._search.suggestions(this.input).then((res:any) => {

    console.log('res: ', res)
      Object.values(res).map((sug: any) => {
        console.log('sug: ', sug)
        if(this.checkString(sug)){
          this.suggestedMovies.push(sug);

          if(this.checkDireccionString(sug.director)){
            this.suggestedDireccion.push(sug.director)
          }
        }
        else{
          this.suggestedMovieGenres.push(sug);
        }
        console.log('suggestedMovies: ', this.suggestedMovies);
      })

      this.genreSuggestion();
    })
  }

  checkString(item: any) {
    return item.title.toString().toLowerCase().includes(this.input) ||
          item.director.toString().toLowerCase().includes(this.input) ||
          item.year.toString().toLowerCase().includes(this.input);
  }

  checkDireccionString(item: any) {
    return item.split(' ').join('').toLocaleLowerCase().includes(this.input);
  }

  onSuggestedClick(input: any) {
    this._shared.searchValue(input);
    this.router.navigate(['/results'], {queryParams: {search: input}})
  }

  genreSuggestion(){
    this.suggestedGenres = [];
    for(let i = 0; i < this.genres.length; i++){
      if(this.genres[i].name.toLowerCase().includes(this.input)){
        this.suggestedGenres.push(this.genres[i].name);
      }
    }
    // console.log('Géneros sugeridos en search: ', this.suggestedGenres);
  }
}
