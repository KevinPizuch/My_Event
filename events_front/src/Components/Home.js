import React, { Component, Fragment } from 'react'
import axios from 'axios'
import Toast from 'light-toast';
import ReactHtmlParser from 'react-html-parser';
import imgEvent from '../Assets/img1.jpg'
import Header from './Header'
import Cookies from 'universal-cookie';
import Maps from './Maps'
import AutoScroll from '@brianmcallister/react-auto-scroll';


class Home extends Component {
    constructor(props) {
        super(props);
        this.searchRef = React.createRef();
        this.optionRef = React.createRef();
        this.guestChatRef = React.createRef();
        this.guestInviteRef = React.createRef();
        this.myRef = React.createRef()  
        this.state = { 
            event : [],
            options : [],
            city : [],
            value : '',
            search : false,
            searchEv : [],
            position : 'Home',
            current_event : [],
            name : '',
            email : '',
            picture : '',
            user_id : '',
            owner : null,
            guests : null,
            temp : '',
            weather : '',
            msg : [],
            index : 0
        }
    }
    
    componentDidMount(){
        Toast.loading('Loading all events around you !')
        axios.get(`http://api.eventful.com/rest/events/search?app_key=WdwsKtNbRr4ZvPRk&where=${localStorage.getItem('latitude')},${localStorage.getItem('longitude')}&within=25`)
        .then(reponse =>{
            var convert = require('xml-js');
            var result2 = convert.xml2js(reponse.data, {compact: true, spaces: 4});
            console.log(result2.search.events.event)
            this.setState({event : result2.search.events.event})
            Toast.hide();
            })
          axios.get('http://api.eventful.com/rest/categories/list?app_key=WdwsKtNbRr4ZvPRk')
            .then(reponse =>{
                var convert = require('xml-js');
                var result2 = convert.xml2js(reponse.data, {compact: true, spaces: 4});
                this.setState({options : result2.categories.category})
            })
    }

     handleEventInfo = (event) =>{
         
        this.setState({current_event : event})
        const cookies = new Cookies();
        if(cookies.get('user')){
            
            axios.post('http://localhost:8000/api/user/isowner', {owner :  cookies.get('user'), id_event: event._attributes.id})
            .then((response =>{
                if(response.data === 'true'){
                    this.setState({owner : <button onClick={this.handleOpenEventGrp}>See my party</button>})
                }else{
                    this.setState({owner : null})
                }
                this.setState({position : 'Event-info'})
            }))
        }else{
            this.setState({position : 'Event-info'})
        }
       
    }
    handleReturnToHome = () =>{
        this.setState({position : 'Home'})
    }
    account = () =>{
        this.setState({position : 'Account'})
    }
    searchHandle = (e) =>{
        if(this.searchRef.current.value !== '' && this.optionRef.current.value !== 'All'){
        Toast.loading('Our chinese people are working on it...');
             axios.get(`http://api.eventful.com/rest/events/search?app_key=WdwsKtNbRr4ZvPRk&keywords=${this.optionRef.current.value}&location=${this.searchRef.current.value}&date=Future`)
                .then((reponse =>{
                    Toast.hide();
                    var convert = require('xml-js');
                    var result2 = convert.xml2js(reponse.data, {compact: true, spaces: 4});
                    if(result2.search.total_items._text !== '0'){
                        Toast.success('We found ' + result2.search.events.event.length + ' event for you !', 1500);
                        const result = result2.search.events.event.map((event) => (
                            <div key={event._attributes.id} className="event-wrap">
                                <div className="event-img">
                                    { event.image.url ? <img  alt={'event_img'} src={event.image.url._text} /> : <p>no img</p> }
                                </div>
                                <div className="event-info">
                                    <h2>{event.title._text}</h2>
                                        <p>{ReactHtmlParser(event.description._text)}</p>
                                    <br />
                                    <button>En savoir +</button>
                                </div>
                            </div>
                        ))
                        this.setState({searchEv : result})
                        this.setState({ search : true })
                    }else{
                        Toast.fail('There is no event', 1000);
                    }
                }))
            
        }else if(this.optionRef.current.value === 'All' && this.searchRef.current.value !== ''){
            Toast.loading('Our chinese people are working on it...');

             axios.get(`http://api.eventful.com/rest/events/search?app_key=WdwsKtNbRr4ZvPRk&location=${this.searchRef.current.value}&date=Future`)
                .then((reponse =>{
                    Toast.hide();
                    var convert = require('xml-js');
                    var result2 = convert.xml2js(reponse.data, {compact: true, spaces: 4});
                    if(result2.search.total_items._text !== '0'){
                        Toast.success('We found ' + result2.search.events.event.length + ' event for you !', 1500);
                        const result = result2.search.events.event.map((event) => (
                            <div key={event._attributes.id} className="event-wrap">
                                <div className="event-img">
                                    { event.image.url ? <img alt={'event_img'} src={event.image.url._text} /> : <p>no img</p> }
                                </div>
                                <div className="event-info">
                                    <h2>{event.title._text}</h2>
                                        <p>{ReactHtmlParser(event.description._text)}</p>
                                    <br />
                                    <button>En savoir +</button>
                                </div>
                            </div>
                        ))
                            this.setState({searchEv : result})
                            this.setState({ search : true })
                    }else{
                        Toast.fail('There is no event', 1000);
                    }
                }))
            
        }else if(this.optionRef.current.value !== 'All' && this.searchRef.current.value === ''){
            Toast.loading('Our chinese people are working on it...');

             axios.get(`http://api.eventful.com/rest/events/search?app_key=WdwsKtNbRr4ZvPRk&keywords=${this.optionRef.current.value}&location=${localStorage.getItem('latitude')},${localStorage.getItem('longitude')}&within=25`)
                .then((reponse =>{
                    Toast.hide();
                    var convert = require('xml-js');
                    var result2 = convert.xml2js(reponse.data, {compact: true, spaces: 4});
                    if(result2.search.total_items._text !== '0'){
                        Toast.success('We found ' + result2.search.events.event.length + ' event for you !', 1500);
                        const result = result2.search.events.event.map((event) => (
                            <div key={event._attributes.id} className="event-wrap">
                                <div className="event-img">
                                    { event.image.url ? <img alt={'event_img'} src={event.image.url._text} /> : <p>no img</p> }
                                </div>
                                <div className="event-info">
                                    <h2>{event.title._text}</h2>
                                        <p>{ReactHtmlParser(event.description._text)}</p>
                                    <br />
                                    <button>En savoir +</button>
                                </div>
                            </div>
                        ))
                        this.setState({searchEv : result})
                        this.setState({ search : true })
                    }else{
                        Toast.fail('There is no event', 1000);
                    }
                }))
        }else if(this.optionRef.current.value === 'All' && this.searchRef.current.value === ''){
            this.setState({ search : false })
        }
        Toast.hide();
    
        
    }
    handleCreateEvent = () =>{
        const cookies = new Cookies();
        if(cookies.get('fb_user')){
            const cookies = new Cookies();
            axios.post('http://localhost:8000/api/user/connected', {user_id:cookies.get('fb_user')})
            .then((response=>{
                this.setState({name : response.data.name})
                this.setState({email : response.data.email})
                this.setState({picture : response.data.picture})
                this.setState({user_id : response.id})
                axios.post('http://localhost:8000/api/user/newevent', {owner_name: this.state.name, id_event: this.state.current_event._attributes.id, guest_name: this.state.name, guest_picture: this.state.picture})
                .then((response =>{
                    if(response.data === 'created'){
                        Toast.success('Successfully created !', 1000)
                        this.xd()
                        this.displayGuestChat()
                        this.setState({position : 'EventCreate'})
                    }else if(response.data === 'already created by this person'){
                        this.xd()
                        this.displayGuestChat()

                        this.setState({position : 'EventCreate'})
                    }else{
                        Toast.fail('You already created this', 1000)
                        this.setState({position : 'Home'})
                        }
                    }))
                }))
        }else{
            //this.setState({position : 'Home'})
            Toast.fail('You are not allowed to do this, please log in', 1000);
        }
    }
    handleOpenEventGrp = () =>{
        this.setState({position : 'EventCreate'})
    }
    handleGuestChat = () =>{
        if(this.guestChatRef.current.value !== ""){
            axios.post('http://localhost:8000/api/user/newmsg', {name : this.state.name, content:this.guestChatRef.current.value, id_event: this.state.current_event._attributes.id})
                .then((response =>{
                    this.displayGuestChat()
                    this.guestChatRef.current.value = ""
                }))
        }       
    }
    displayGuestChat = () =>{
        axios.post('http://localhost:8000/api/user/getmsg', {name : this.state.name, id_event: this.state.current_event._attributes.id})
            .then((response =>{
                console.log(response.data)
                if(response.data !== 'no_msg'){
                    this.setState({msg : response.data.map((message) =>(
                        message.name === this.state.name ? <div className="my-msg"><p>{message.content}</p></div> : <div className="other-msg"><p><strong>{message.name}</strong> : {message.content}</p></div>
                    ))})
                }else{
                    this.setState({msg : <p>no msg yet</p>})
                }
            }))
    }
    xd = () =>{
        axios.post('http://localhost:8000/api/user/getguests', {owner :this.state.name, id_event: this.state.current_event._attributes.id})
        .then((response =>{
            const x = (
                <div className="guest-wrap">{response.data.map((elem) => (
                    <div>
                        <img src={elem.picture}></img><br/>
                        <span>{elem.status}</span><br/>
                        <span>{elem.name}</span>
                    </div>
                
                ))}</div>
            )
            this.setState({guests : x})
            console.log(this.state.guests)
            axios.get(`http://api.openweathermap.org/data/2.5/weather?appid=9044e687f2a2e85ea8015b10b39c09ce&lang=en&units=metric&lat=${this.state.current_event.latitude._text}&lon=${this.state.current_event.longitude._text}`)
                    .then((response=>{
                        this.setState({temp: response.data.main.temp, weather: response.data.weather[0].description})
                        console.log(response.data)
                    }))
        }))

    }
    
    handleGuestInvite = () =>{
        const newGuest = this.guestInviteRef.current.value
        Toast.loading('We are requesting this person :O')
        axios.post('http://localhost:8000/api/user/newguest', {owner: this.state.name, user_name : newGuest, id_event:this.state.current_event._attributes.id})
            .then((response =>{
                if(response.data == 'error'){
                    Toast.hide()
                    Toast.fail('Error we cannot find this perso :( ',600)
                }else{
                    Toast.hide()
                    this.xd()
                    Toast.success('Successfully added to event : ' + this.state.current_event.title._text, 1000)
                }
                
            }))
    }

    a = () =>{
        var element = document.getElementById("xd");
        element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
        console.log('xxxaaxx')
    }
    render() {
        
        const events = this.state.event.map((event) => (
            <div key={event._attributes.id} className="event-wrap">
                <div className="event-img">
                    { event.image.url ? <img alt={'event_img'} src={event.image.url._text} /> : <p>no img</p> }
                </div>
                <div className="event-info">
                    <h2>{event.title._text}</h2>
                        <p>{ReactHtmlParser(event.description._text)}</p>
                    <br />
                    <button onClick={()=>this.handleEventInfo(event)}>En savoir +</button>
                </div>
            </div>
        ))
        const options = this.state.options.map((option, index) =>(
            <option key={option.id._text}>{option.id._text}</option>
        ))
        
        if(this.state.position === 'Home'){
            return (
                <Fragment>
                <Header
                    account={ this.account.bind(this) } 
                />
                <div className="body-wrap">
                    <div className="body-search">
                        <div className="input-search">
                            <label>ville</label>
                            <input ref={this.searchRef} placeholder='Ville'></input>
                        </div>
                        <div className="input-search">
                            <label>catégorie</label>
                            <select ref={this.optionRef}>
                                <option>All</option>
                                {options}
                            </select>
                        </div>
                        <button onClick={this.searchHandle}>Filter</button>
                    </div>
                    <div className="body-display">
                        {this.state.search ? this.state.searchEv : events}
                    </div>
                </div>
                </Fragment>
            );
        }else if(this.state.position === 'Event-info'){
            return (
                <Fragment>
                <Header
                    account={ this.account.bind(this) } 
                />
               <div className="event-info-wrap">
                   <div className="event-info-top">
                       <div className="event-info-img">
                           {this.state.current_event.image.url ? <img alt={'event_img'} src={this.state.current_event.image.url._text}/> : <img alt={'event_img'} src={imgEvent}/> }
                       </div>
                       <div className="event-info-date">
                        <h3>{this.state.current_event.title._text}</h3>
                        <br />
                        <p>Date : {this.state.current_event.start_time._text}</p>
                        <p>Lieu : {this.state.current_event.venue_name._text}</p>
                        <br />
                        {this.state.owner !== null ? <button onClick={this.handleCreateEvent}>See my party</button> : <button onClick={this.handleCreateEvent}>Organiser une sortie !</button>} 
                       </div>
                   </div>
                   <div className="event-info-description">
                        <h4>Description event</h4>
                        <p>{ReactHtmlParser(this.state.current_event.description._text)}</p>
                        <br />
                        <button onClick={this.handleReturnToHome}>Retour</button>
                   </div>
               </div>
               </Fragment>
            )
        }else if(this.state.position === 'Account'){
            return (
                <Fragment>
                    <Header
                        account={ this.account.bind(this) } 
                    />
                <p>suuup</p>
                </Fragment>
            )
        }else if(this.state.position === 'EventCreate'){
            return (
                <Fragment>
                    <Header
                        account={ this.account.bind(this) } 
                    />
                    <div className="event_container_chat">
                        <center><h3>Sortie : {this.state.current_event.title._text}</h3></center>
                        <center>
                        <Maps
                            lat = { parseFloat(this.state.current_event.latitude._text) }
                            lng = { parseFloat(this.state.current_event.longitude._text) }
                            />
                            <h4>{this.state.weather} --  {this.state.temp}°C</h4>
                                                  
                            <h4>Owner : {this.state.name}</h4>
                            <label>Private</label>
                            <label className="switch">
                            <input type="checkbox"></input>
                            <span className="slider round"></span>
                            </label>

                           
                            <div className="create-event-wrap">
                                <div className="guest-list">
                                    <h4>Guest list</h4>
                                    <input placeholder="le nom de votre ami.." ref={this.guestInviteRef}></input>
                                    <button onClick={this.handleGuestInvite}>Invite</button>
                                    <div className="line"></div>
                                    {this.state.guests}
                                </div>
                                <div className="guest-chat">
                                    <div className="guest-chat-window">
                                        <h4>Guest chat</h4>
                                        <div className="guest-chat-feed">
                                             {this.state.msg}
                                        </div>
                                    </div>
                                    <div className="guest-chat-input">
                                        <input placeholder="Votre message..." ref={this.guestChatRef}></input>
                                        <button onClick={this.handleGuestChat}>Send</button>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    <button onClick={() => this.setState({position:'Home'})}>retour</button>
                </Fragment>
            )
        }
    }
}
 
export default Home;