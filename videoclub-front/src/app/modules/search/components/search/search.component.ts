import { Component, EventEmitter, Output } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {
  inputSearch = new FormControl('');
  submitted: any;
  results: any;

  constructor(
    private router: Router,
  ) {}

  ngOnInit(): void {
    // this.onChange();
  }

  onChange(): void {
    this.inputSearch.valueChanges.pipe(
      debounceTime(350),                      //espera 350ms para enviar la petición
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

  // onSearch(term: string): void {
  //   console.log('term: ', term);
  //   this.router.navigate(['/results'], {queryParams: {search: term}});
  // }
}
