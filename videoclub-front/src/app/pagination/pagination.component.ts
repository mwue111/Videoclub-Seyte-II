import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

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

  constructor() {}

  ngOnInit(): void {
    // console.log('data: ', this.data);
    this.currentPage = this.data.current_page;
    this.totalPages = this.data.last_page;
    for(let i = 1; i <= this.data.last_page; i++){
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
