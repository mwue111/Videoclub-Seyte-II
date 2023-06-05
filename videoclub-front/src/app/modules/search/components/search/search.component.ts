import { Component, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { Router } from '@angular/router';
import { SearchSharedServiceService } from 'src/app/services/search-shared-service.service';
import { SearchService } from '../../_services/search.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css'],
})
export class SearchComponent {
  submitted: any = '';
  results: any;
  inputSearch = new FormControl('');
  value: string = '';
  data: any;
  suggestions: any = [];
  fields: any;
  suggestedMovies: any = [];
  suggestedGenres: any = [];
  input: string = '';

  constructor(
    private router: Router,
    private _shared: SearchSharedServiceService,
    private _search: SearchService,
  ) {}

  ngOnInit() {
    this._shared.query$.subscribe(receivedQuery =>
      this.value = receivedQuery
    )
  }

  onChange(): void {
    this.inputSearch.valueChanges.pipe(
      debounceTime(350),                      //espera 350ms para enviar la petición
      distinctUntilChanged(),                 //verifica que el valor a emitir no es igual al ya emitido
      filter((search:any) => search !== ''),  //se asegura que no llegue un string vacío
      tap((res: any) => {
        this.submitted = res;
        this.getSuggestions(res);
      })
    ).subscribe();
  }

  onSearch(): void {
    this.router.navigate(['/results'], {queryParams: {search: this.submitted}});
  }

  getSuggestions(event: any) {
    this.input = event.target.value;
    this._search.suggestions(this.input).then((res:any) => {
      this.data = res;
      console.log('data: ', this.data);
      Object.values(res).map((sug: any) => {
        if(this.checkString(sug)){
          this.suggestedMovies.push(sug);
        }
        else{
          this.suggestedGenres.push(sug);
        }
      })
    })
  }

  checkString(item: any) {
    return item.title.toString().toLowerCase().includes(this.input) ||
          item.director.toString().toLowerCase().includes(this.input) ||
          item.year.toString().toLowerCase().includes(this.input);
  }
}
