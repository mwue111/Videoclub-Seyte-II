import { Component, Input, OnInit } from '@angular/core';
import { CommentsService } from '../../_services/comments.service';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { CommentInterface } from '../../types/comment.interface';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'comments',
  templateUrl: './comments.component.html',
  styleUrls: ['./comments.component.css']
})
export class CommentsComponent implements OnInit {
  @Input() currentUserId: any; //o string + añadir !.
  comments: CommentInterface[] = [];
  displayComments: boolean = true;
  movieId: any;

  constructor(
    private _comments: CommentsService,
    private _auth: AuthService,
    private route: ActivatedRoute,
  ) {}

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.movieId = params.get('id');
      if(this.movieId){
        this._comments.getMovieComments(this._auth.token, Number(this.movieId))
            .subscribe((res: any) => {
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

}
