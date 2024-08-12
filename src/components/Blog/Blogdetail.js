import axios from "axios";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Comment from "./Comment";
import ListComment from "./Listcomment";
import Rate from "./Rate";

function BlogDetail() {
    let params = useParams();
    const [data, setData] = useState(null);
    const [comments, setComments] = useState([]);
    const [parentCommentId, setParentCommentId] = useState(0);

    useEffect(() => {
        axios.get('http://localhost/laravel8/laravel8/public/api/blog/detail/' + params.id)
            .then(response => {
                setData(response.data.data);
                setComments(response.data.data.comments || []);
            })
            .catch(error => console.log(error));
    }, [params.id]);

    const addComment = (newComment) => {
        setComments([newComment, ...comments]);
    };

    function renderData() {
        if (data) {
            return (
                <div className="single-blog-post">
                    <h3>{data.title}</h3>
                    <div className="post-meta">
                        <ul>
                            <li><i className="fa fa-user" />{data.author}</li>
                            <li><i className="fa fa-clock-o" />{data.time}</li>
                            <li><i className="fa fa-calendar" />{data.date}</li>
                        </ul>
                        <span>
                            <i className="fa fa-star"></i>
                            <i className="fa fa-star"></i>
                            <i className="fa fa-star"></i>
                            <i className="fa fa-star"></i>
                            <i className="fa fa-star-half-o"></i>
                        </span>
                    </div>
                    <a href="#">
                        <img src={`http://localhost/laravel8/laravel8/public/upload/Blog/image/${data.image}`} alt="Blog" />
                    </a>
                    <p>{data.content}</p>
                </div>
            );
        }
        return null;
    }

    return (
        <section>
            <div className="container">
                <div className="row">
                    <div className="col-sm-3">
                        <div className="left-sidebar">
                            <h2>Category</h2>
                        </div>
                    </div>
                    <div className="col-sm-9">
                        <div className="blog-post-area">
                            <h2 className="title text-center">Latest From our Blog</h2>
                            {renderData()}
                            <Rate />
                            <ListComment comments={comments} setParentCommentId={setParentCommentId} />
                            <Comment idBlog={params.id} addComment={addComment} parentCommentId={parentCommentId} setParentCommentId={setParentCommentId} />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default BlogDetail;
