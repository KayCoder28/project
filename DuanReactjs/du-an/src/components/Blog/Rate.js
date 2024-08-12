import React, { useState, useEffect } from 'react';
import StarRatings from 'react-star-ratings';
import axios from 'axios'; // Sử dụng axios để gọi API

function Rate({ user_id, blog_id }) {
  const [rating, setRating] = useState(0);
  const [averageRating, setAverageRating] = useState(0);
  const [votes, setVotes] = useState(0);
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [userAuth, setUserAuth] = useState(null);
  const [token, setToken] = useState("");

  useEffect(() => {
    const storedUser = localStorage.getItem("user");
    if (storedUser) {
      const parsedUser = JSON.parse(storedUser);
      setIsLoggedIn(true);
      setUserAuth(parsedUser);
    }

    const storedToken = localStorage.getItem("token");
    if (storedToken) {
      setToken(JSON.parse(storedToken));
    }

    // Lấy rating trung bình khi tải trang
    axios.get(`http://localhost/laravel8/laravel8/public/api/blog/rate/id`)
      .then(response => {
        const { average, votes } = response.data;
        setAverageRating(average);
        setVotes(votes);
      })
      .catch(error => console.error('Lỗi khi đánh giá', error));
  }, [blog_id]);

  const changeRating = (newRating) => {
    if (!isLoggedIn) {
      alert('Vui Lòng Login để đánh giá !');
      return;
    }

    const config = {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    };

    axios.post(`http://localhost/laravel8/laravel8/public/api/blog/rate/id`, { user_id: userAuth.id, blog_id, rate: newRating }, config)
      .then(response => {
        setRating(newRating);
        const { average, votes } = response.data;
        setAverageRating(average);
        setVotes(votes);
      })
      .catch(error => console.error('Lỗi khi gửi đánh giá', error));
  };

  return (
    <div className="rating-area">
      <ul className="ratings">
        <li className="rate-this">Rate this item:</li>
        <li>
          <StarRatings
            rating={rating}
            starRatedColor="blue"
            changeRating={changeRating}
            numberOfStars={5}
            name='rating'
          />
        </li>
        <li className="color">({votes} votes)</li>
      </ul>
      <ul className="tag">
        <li>TAG:</li>
        <li><a className="color" href="">Pink <span>/</span></a></li>
        <li><a className="color" href="">T-Shirt <span>/</span></a></li>
        <li><a className="color" href="">Girls</a></li>
      </ul>
    </div>
  );
}

export default Rate;
