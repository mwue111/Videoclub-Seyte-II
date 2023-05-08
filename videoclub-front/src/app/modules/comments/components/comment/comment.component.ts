import { Component, Input, OnInit } from '@angular/core';
import { CommentInterface } from '../../types/comment.interface';
import { CommentsService } from '../../_services/comments.service';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';

@Component({
  selector: 'comment',
  templateUrl: './comment.component.html',
  styleUrls: ['./comment.component.css']
})
export class CommentComponent implements OnInit {
  @Input() comment!: CommentInterface;
  username: string = '';
  displayComment: boolean = true;
  canEdit: boolean = true;
  canDelete: boolean = true;

  constructor(
    private _comments: CommentsService,
    private route: ActivatedRoute,
    private _auth: AuthService,
  ) {}

  ngOnInit() {
      this.route.paramMap.subscribe(params => {
        const movieId = params.get('id');
        if(movieId){
          this._comments.getAuthors(movieId)
              .subscribe((res: any) => {
                // if(res !== 'none' && Number(movieId) === this.comment.movie_id) {
                  const user = res.find((user: any) => user.id === this.comment.user_id);
                  if(user){
                    this.username = user.username;
                  }
                // }
                // else{
                //   this.displayComment = false;
                // }
          });
        }
      });

      const fiveMinutes = 300000;
      const timePassed = new Date().getMilliseconds() - new Date(this.comment.created_at).getMilliseconds() > fiveMinutes;

      // this.canEdit = Boolean(this._auth.isLogged());
      this.canEdit = Boolean(this._auth.isLogged()) && this._auth.user.id === this.comment.user_id && !timePassed;
      this.canDelete = Boolean(this._auth.isLogged()) && this._auth.user.id === this.comment.user_id && !timePassed;
  }



}
