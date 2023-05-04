import { NgModule } from "@angular/core";
import { CommentsComponent } from "./components/comments/comments.component";
import { CommentsService } from "./_services/comments.service";

@NgModule({
  declarations: [
    CommentsComponent,
  ],
  exports: [
    CommentsComponent,
  ],
  providers: [
    CommentsService,
  ]
})
export class CommentsModule {}
