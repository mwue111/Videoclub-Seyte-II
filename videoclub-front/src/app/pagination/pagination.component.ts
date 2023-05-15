import { Component, OnInit, Input, Output, EventEmitter, SimpleChanges } from '@angular/core';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.css']
})
export class PaginationComponent implements OnInit {
  @Input() data!: any;
  @Output() changePage: EventEmitter<any | null> = new EventEmitter<any | null>();

  currentPage!: number;
  totalPages!: number;
  allPages: any = [];

  constructor() {
  }

  ngOnChanges(changes: SimpleChanges) {

    if(changes['data'] && !changes['data']['firstChange']){
      const newLastPage = changes['data']['currentValue']['last_page'];
      const oldLastPage = changes['data']['previousValue']['last_page'];

      if(newLastPage !== oldLastPage){
        this.totalPages = newLastPage;
        this.updateTotalPages(this.totalPages);
      }
    }
  }

  ngOnInit(): void {
    if(this.data){
      this.currentPage = this.data.current_page;
      this.totalPages = this.data.last_page;
      this.updateTotalPages(this.totalPages);
    }
  }

  updateTotalPages(total: number) {
    this.allPages = [];
    for(let i = 1; i <= total; i++){
      this.allPages.push(i);
    }
  }

  prevPage(page: any) {
    this.currentPage = page - 1;
    this.onPageChange(this.currentPage);
  }

  nextPage(page:any) {
    this.currentPage = page + 1;
    this.onPageChange(this.currentPage);
  }

  goToPage(page: number){
    this.currentPage = page;
    this.onPageChange(page);
  }

  onPageChange(page: any): void {
    this.changePage.emit(page);
  }
}
