import React, {Component} from 'react'
import Toast from 'light-toast';
import axios from 'axios'
import Cookies from 'universal-cookie';
import FacebookLogin from 'react-facebook-login';
class Header extends Component {
    
    constructor(props) {
      super(props);
   
      
      this.state = {
       
        username: null,
        name : '',
        email : '',
        picture : '',
        user_id : ''
      };
    }
    

    responseFacebook = (response) => {
      console.log(response);
      Toast.success('Success', 1000);
      this.setState({name : response.name})
      this.setState({email : response.email})
      this.setState({picture : response.picture.data.url})
      this.setState({user_id : response.id})
      sessionStorage.setItem('user_id',response.id)
      //check user --> back @@@@@@@@@@@@@@@
      axios.post('http://localhost:8000/api/user/check', {email: response.email, name: response.name, picture:response.picture.data.url, id_user:response.id})
        .then((response =>{
          if(response.data === "connected"){
            let d = new Date();
            d.setTime(d.getTime() + (60*60*1000));
            const cookies = new Cookies();
            cookies.set('fb_user', this.state.user_id, { path: '/', expires: d });
            cookies.set('user', this.state.name, { path: '/', expires: d });
            console.log(cookies.get('fb_user'));
            sessionStorage.setItem('status','connected')
          }
        }))
    }

    fbDisconect = () =>{
      const cookies = new Cookies();
      this.setState({name : ''})
      this.setState({email : ''})
      this.setState({picture : ''})
      sessionStorage.removeItem('user_id')
      cookies.remove('fb_user')
      cookies.remove('user')
    }

   
    
     componentDidMount(){
      const cookies = new Cookies();
      if(cookies.get('fb_user')){
         axios.post('http://localhost:8000/api/user/connected', {user_id:cookies.get('fb_user')})
          .then((response=>{
            this.setState({name : response.data.name})
            this.setState({email : response.data.email})
            this.setState({picture : response.data.picture})
          }))
      }
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.showPos);
      }else{
        alert('Our website cannot work without your location')
      }
    }

    
   
    showPos = (position)=>{
        this.setState({pos : position})
        localStorage.setItem('latitude',position.coords.latitude)
        localStorage.setItem('longitude',position.coords.longitude)
    }
    render() {
        const fb = (
          <FacebookLogin
          appId="639730746843702"
          autoLoad={true}
          size='metro'
          fields="name,email,picture"
          scope="public_profile,user_friends"
          callback={this.responseFacebook} />
        )

        const user = (
          <div className="actual_user">
            <img alt={'fb_picture'} src={this.state.picture} />
            <span>{this.state.name}</span>
            <br />
            <button onClick={this.props.account} >My account</button>
            <button onClick={this.fbDisconect} >disconect</button>
          </div>
        )
          
        
        return ( 
                <div className="header-wrap">
                    <div className="logo">
                        MY_EVENTS.COM
                    </div>
                    <div className="facebook">
                      { this.state.name ? user : fb }
                    </div>
                </div>
                );
            }
}
 
export default Header;