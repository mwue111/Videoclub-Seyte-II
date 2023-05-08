import { Component, Input } from '@angular/core';
import { CommentInterface } from '../../types/comment.interface';
import { CommentsService } from '../../_services/comments.service';

@Component({
  selector: 'comment',
  templateUrl: './comment.component.html',
  styleUrls: ['./comment.component.css']
})
export class CommentComponent {
  @Input() comment!: CommentInterface;
  username: string = '';

  constructor(
    private _comments: CommentsService,
  ) {

    //Obtener los datos de cada autor de cada reseña:
    this._comments.getAuthors(1)
        .subscribe((res: any) => {
          const user = res.find((user: any) => user.id === this.comment.user_id);
          if(user){
            this.username = user.username;
          }
        })
  }



}
