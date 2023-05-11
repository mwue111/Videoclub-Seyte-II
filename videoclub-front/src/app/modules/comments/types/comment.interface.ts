export interface CommentInterface {
  id: number;
  title: string;
  description: string;
  user_id: any;
  movie_id: number;
  created_at: any | null;  //string o datetime si da error
  updated_at: any | null;
  deleted_at: any | null;
}
