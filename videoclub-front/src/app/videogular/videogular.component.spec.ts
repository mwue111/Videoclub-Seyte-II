import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VideogularComponent } from './videogular.component';

describe('VideogularComponent', () => {
  let component: VideogularComponent;
  let fixture: ComponentFixture<VideogularComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VideogularComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VideogularComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
