import React, { useState, useEffect } from "react";
import axios from "axios";

function Comment({ idBlog, addComment, parentCommentId, setParentCommentId }) {
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const [commentContent, setCommentContent] = useState("");
    const [userAuth, setUserAuth] = useState(null);
    const [token, setToken] = useState("");

    useEffect(() => {
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            const parsedUser = JSON.parse(storedUser);
            console.log("Parsed User: ", parsedUser);
            setIsLoggedIn(true);
            setUserAuth(parsedUser);
        } else {
            console.log("No user found in localStorage");
        }

        const storedToken = localStorage.getItem("token");
        if (storedToken) {
            console.log("Parsed Token: ", JSON.parse(storedToken));
            setToken(JSON.parse(storedToken));
        } else {
            console.log("No token found in localStorage");
        }
    }, []);

    const handleCommentSubmit = async (e) => {
        e.preventDefault();

        if (!isLoggedIn) {
            alert("Vui lòng đăng nhập để bình luận.");
            return;
        }

        if (!commentContent.trim()) {
            alert("Vui lòng nhập nội dung bình luận.");
            return;
        }

        if (!userAuth || !userAuth.id) {
            alert("Không thể xác thực người dùng.");
            console.log("User Auth:", userAuth);
            console.log("Token:", token);
            return;
        }

        try {
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            };

            const formData = new FormData();
            formData.append('id_blog', idBlog);
            formData.append('id_user', userAuth.id);
            formData.append('id_comment', parentCommentId);
            formData.append('comment', commentContent);
            formData.append('image_user', userAuth.avatar);
            formData.append('name_user', userAuth.name);

            axios.post('http://localhost/laravel8/laravel8/public/api/blog/comment/id', formData, config)
                .then(response => {
                    console.log(response);
                    const newComment = response.data.data;
                    addComment(newComment);
                    setCommentContent("");
                    setParentCommentId(0);
                })
                .catch(error => {
                    alert("Có lỗi xảy ra khi gửi bình luận: " + error.message);
                });
        } catch (error) {
            alert("Có lỗi xảy ra khi gửi bình luận: " + error.message);
        }
    };

    return (
        <div className="replay-box">
            <div className="row">
                <div className="col-sm-12">
                    <h2>Leave a reply</h2>
                    <div className="text-area">
                        <div className="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <form onSubmit={handleCommentSubmit}>
                            <textarea
                                name="message"
                                rows="11"
                                value={commentContent}
                                onChange={(e) => setCommentContent(e.target.value)}
                            ></textarea>
                            <button type="submit" className="btn btn-primary">
                                Post Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Comment;
