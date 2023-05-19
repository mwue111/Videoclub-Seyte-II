import { TestBed } from '@angular/core/testing';

import { UserSharedServiceService } from './user-shared-service.service';

describe('UserSharedServiceService', () => {
  let service: UserSharedServiceService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(UserSharedServiceService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
