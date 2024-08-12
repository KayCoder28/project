import { useState } from "react";
import axios from "axios";
import Error from "../Error/FormError";

function Register(props){
    const [formData , setData] = useState({
        name : '',
        email: '',
        password: '',
        phone: '',
        address: '',
        level: '0',
    })
    const [errors, setErrors] = useState({});

    const [getFile, setFile] = useState("");
    const [getAvatar, setAvatar] = useState("");

    const handleInput = (e) => {
        const { name, value } = e.target;
        setData(state => ({...state,[name]: value}));
    };

    function handleUserInputFile (e) {
        const file = e.target.files;
        setFile(file);


        let reader = new FileReader();
        reader.onload = (e) => {
            setAvatar(e.target.result)
           
        };
        reader.readAsDataURL(file[0]);
    };


    const handleSubmit = (e) => {
        e.preventDefault();
       

        let errorsSubmit = {};
        let flag = true;

        if (!formData.name) {
            errorsSubmit.name = "Vui lòng nhập name";
            flag = false;
        }
        if (!formData.email) {
            errorsSubmit.email = "Vui lòng nhập email";
            flag = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            errorsSubmit.email = "Email không đúng định dạng";
            flag = false;
        }

        if (!formData.password) {
            errorsSubmit.password = "Vui lòng nhập mật khẩu";
            flag = false;
        }

        if (!formData.phone) {
            errorsSubmit.phone = "Vui lòng nhập Số Điện Thoại"
            flag = false;
        }

        if (!formData.address) {
            errorsSubmit.address = "Vui lòng nhập địa chỉ"
            flag = false;
        }

        if (getFile == "") {
            errorsSubmit.avatar = "Vui lòng chọn hình ảnh";
            flag = false;
        }else{
            console.log(getFile)
            let getSize =  getFile[0].size;  //byte

            // 1gb = 1024mb = 1024kb = 1024byte 
            if(getSize > 1024 * 1024){
                errorsSubmit.avatar = "Kích thước hình ảnh phải nhỏ hơn hoặc bằng 1MB";
                flag = false
            }

            // hinh anh la file có đuôi của tên file : jpg, png, jpeg// 
            let fileName = getFile[0].name;
            let fileExtension = fileName.split('.').pop();
            let checkImg = ["jpg", "png", "jpeg"]
            if (!checkImg.includes(fileExtension.toLowerCase())) {
                errorsSubmit.avatar = "Hình ảnh phải có định dạng jpg, png hoặc jpeg";
                flag = false;
            }
        }

        if (!flag) {
            setErrors(errorsSubmit);
        } else {

            const data = {
                name: formData.name,
                email: formData.email,
                password: formData.password,
                phone: formData.phone,
                address: formData.address,
                level: formData.level,
            }
            axios.post("http://localhost/laravel8/laravel8/public/api/register", data)
            .then((res) => {
                console.log(res);
                alert('Đăng ký thành công');
                // Đoạn mã xử lý sau khi đăng ký thành công
            })
            .catch((error) => {
                console.error("Error registering:", error);
                setErrors({ email: "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại sau." });
            });

                }

            }

    return (
        <div>
            <Error errors={errors} />
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <input type="text" placeholder="Name" name="name" onChange={handleInput} />
                <input type="text" placeholder="Email" name="email" onChange={handleInput} />
                <input type="password" placeholder="Mật khẩu" name="password" onChange={handleInput} />
                <input type="text" placeholder="Phone" name="phone" onChange={handleInput} />
                <input type="text" placeholder="Address" name="address" onChange={handleInput} />
                <input type="file" name="avatar" onChange={handleUserInputFile} />
                <input type="text" placeholder="Level" name="level" onChange={handleInput} />
                <button type="submit">Đăng ký</button>
            </form>
        </div>
    );
}
export default Register;