import { Component, Input, OnInit } from '@angular/core';
import { CommentsService } from '../../_services/comments.service';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { CommentInterface } from '../../types/comment.interface';
import { ActivatedRoute } from '@angular/router';
import { ActiveCommentInterface } from '../../types/activeComment.interface';

@Component({
  selector: 'comments',
  templateUrl: './comments.component.html',
  styleUrls: ['./comments.component.css']
})
export class CommentsComponent implements OnInit {

  comments: CommentInterface[] = [];
  activeComment: ActiveCommentInterface | null = null;

  displayComments: boolean = true;
  movieId: any;

  constructor(
    private _comments: CommentsService,
    private _auth: AuthService,
    private route: ActivatedRoute,
  ) {
    this.ngOnInit();
  }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.movieId = params.get('id');
      if(this.movieId){
        this._comments.getMovieComments(this._auth.token, Number(this.movieId))
            .subscribe((res: any) => {
              console.log('¿El back detecta que hay un nuevo comentario? ', res);
              this.comments = res;
              if(res.length === 0){
                this.displayComments = false;
              }
            })
      }
    })
  }

  addComment(review: any): void {
    this._comments.createComment(this._auth.token, review.title, review.description, this._auth.user.email, this.movieId)
        .subscribe((res: any) => {
          this.comments = [...this.comments, res];
        })
  }

  setActiveComment(activeComment: ActiveCommentInterface | null): void {
    this.activeComment = activeComment;
  }

  updateComment({body, commentId}: {body: any, commentId: string|number}){

    this._comments.updateComment(this._auth.token, body.title, body.description, commentId, this._auth.user.id, this.movieId)
        .subscribe((updatedComment: any) => {
          this.comments = this.comments.map((comment) => {
            if(comment.id === commentId) {
              return updatedComment;
            }
            return comment;
          });
          this.activeComment = null;
        });
  }

  deleteComment(commentId: string|number): void {
    this._comments.deleteComment(this._auth.token, commentId)
        .subscribe(() => {
          this.comments = this.comments.filter((comment: any) => comment.id !== commentId);
        })
  }
}
