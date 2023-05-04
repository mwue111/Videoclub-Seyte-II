import { Component, Input, OnInit } from '@angular/core';
import { CommentsService } from '../../_services/comments.service';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { CommentInterface } from '../../types/comment.interface';

@Component({
  selector: 'comments',
  templateUrl: './comments.component.html',
  styleUrls: ['./comments.component.css']
})
export class CommentsComponent implements OnInit {
  @Input() currentUserId: any; //o string + añadir !.
  comments: CommentInterface[] = [];

  constructor(
    private _comments: CommentsService,
    private _auth: AuthService
  ) {}

  ngOnInit(): void {
    this._comments.getComments(this._auth.token)
                  .subscribe((res: any) => {
                    // console.log('comentarios: ', res);
                    this.comments = res;
                  })
  }

}
