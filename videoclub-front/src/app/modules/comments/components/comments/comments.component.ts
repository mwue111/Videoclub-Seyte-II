import { Component, Input, OnInit, ChangeDetectorRef } from '@angular/core';
import { CommentsService } from '../../_services/comments.service';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { CommentInterface } from '../../types/comment.interface';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { ActiveCommentInterface } from '../../types/activeComment.interface';
import Swal from 'sweetalert2';
import { URL_BACKEND } from 'src/app/config/config';
import { Subscription } from 'rxjs';

@Component({
  selector: 'comments',
  templateUrl: './comments.component.html',
  styleUrls: ['./comments.component.css']
})
export class CommentsComponent implements OnInit {
  logged: boolean;
  user: any;
  url: string = URL_BACKEND + '/storage/';
  comments: CommentInterface[] = [];
  activeComment: ActiveCommentInterface | null = null;
  movieId: any;
  data: any;
  reviewId: any;
  highlightedReview!: CommentInterface;

  //paginación
  currentPage: number;
  pageChange: any = null;

  constructor(
    private _comments: CommentsService,
    private _auth: AuthService,
    private route: ActivatedRoute,
    private router: Router,
  ) {
    this.logged = this._auth.isLogged();
    this.user = this._auth.user.user;
    this.currentPage = 1;
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.movieId = params.get('id');
      this.reviewId = params.get('review_id');
      if(this.movieId){
        this.fetchComments(this.currentPage);
      }
      if(this.reviewId){
        console.log('review id: ', this.reviewId);
        this.fetchSingleComment(this.reviewId);
      }
    })
    console.log('user: ', this.user);
  }

  fetchSingleComment(reviewId: number) {
    this._comments.getSingleComment(this._auth.token, reviewId)
        .subscribe((res: any) => {
          console.log('Comentario destacado: ', res);
          this.highlightedReview = res;
          this.comments = this.comments.filter((comment: any) => comment.id !== this.highlightedReview.id);
        })
  }

  fetchComments(page: number, newComment: boolean | null = null) {
    this._comments.getMovieComments(this._auth.token, Number(this.movieId), page, newComment)
        .subscribe((res: any) => {
          if(res !== 'none'){
            console.log('comentarios: ', res.data);
            this.comments = res.data;
            this.data = res;
            this.currentPage = res.current_page;
          }
          else{
            this.comments = [];
          }
    })
  }

  addComment(review: any): void {
    Swal.fire({
      icon: 'success',
      title: '¡Comentario publicado!',
      text: '¡No te preocupes! Si te has equivocado, tienes cinco minutos para editarlo.',
      confirmButtonColor: '#1874BA'
    })

    this._comments.createComment(this._auth.token, review.title, review.description, this._auth.user.user.id, this.movieId)
        .subscribe((res: any) => {
          this.comments = [...this.comments, res];
          this.fetchComments(this.currentPage, true);

          if(this.highlightedReview){
            this.comments = this.comments.filter((comment: any) => comment.id !== this.highlightedReview.id);
            this.fetchSingleComment(this.highlightedReview.id);
          }

        })
  }

  setActiveComment(activeComment: ActiveCommentInterface | null): void {
    this.activeComment = activeComment;
  }

  updateComment({body, commentId}: {body: any, commentId: string|number}){
    console.log('comentario recibido en updateComment, en comments.ts: ', body, ' - ', commentId);
    Swal.fire({
      icon: 'success',
      title: '¡Comentario editado!',
      confirmButtonColor: '#1874BA'
    })
    this._comments.updateComment(this._auth.token, body.title, body.description, commentId, this._auth.user.user.id, this.movieId)
        .subscribe((updatedComment: any) => {
          this.comments = this.comments.map((comment) => {
            if(this.highlightedReview){
              this.fetchSingleComment(this.highlightedReview.id);
            }

            if(comment.id === commentId) {
              return updatedComment;
            }
            return comment;
          });
          this.activeComment = null;
        });
  }

  deleteComment(commentId: string|number): void {
    Swal.fire({
      icon: 'warning',
      title: '¡Cuidado!',
      text: '¿Seguro/a que quieres borrar este comentario? No podrás recuperarlo.',
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonColor: '#FF8811',
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then(res => {
      if(res.isConfirmed){
        Swal.fire({
          icon: 'success',
          title: '¡Comentario eliminado!',
          confirmButtonColor: '#1874BA'
        })

        this._comments.deleteComment(this._auth.token, commentId)
        .subscribe(() => {
          if(this.highlightedReview){
            this.router.navigate([`/pelicula/${this.movieId}`]);
            this.fetchComments(this.currentPage, true);

            if(commentId !== this.highlightedReview.id){
                // console.log('el comentario borrado no es el destacado');
                this.router.navigate([`/review/${this.movieId}/${this.highlightedReview.id}`]);
                this.fetchSingleComment(this.highlightedReview.id);
            }
          }
          else{
            this.router.navigate([`/pelicula/${this.movieId}`]);
            this.fetchComments(this.currentPage, true);
          }
          // this.changePage(this.currentPage);
        })

      }
    })

  }

  changePage(page:number | null){
    if(page !== null){
      this.currentPage = page;
      this.fetchComments(this.currentPage);
    }
  }
}
