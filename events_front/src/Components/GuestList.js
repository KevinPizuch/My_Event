import React, { Component } from 'react'
import axios from 'axios'

class GuestList extends Component {
    constructor(props){
        super(props);
        this.state={
            guests : []
        }
    }
    async componentDidMount(){
        await axios.post('http://localhost:8000/api/user/getguests', {owner : this.props.owner, id_event: this.props.event_id})
        .then((response =>{
            this.setState({guests : response.data})
            console.log(response.data)
            console.log(this.state.guests)
        }))
    }

    xd = () =>{
        axios.post('http://localhost:8000/api/user/getguests', {owner :this.state.name, id_event: this.state.current_event._attributes.id})
        .then((response =>{
            this.setState({guests : response})
            console.log(this.state.guests.data[0])

        }))
    }

    
    
    render() {
        
        // const xd = this.state.guests
        // const options = xd.map((item, i) => (
        //     <li className="travelcompany-input" key={i}>
        //         <span className="input-label">{ i.item.name }</span>
        //     </li>
        // ))
        
        return ( 
            <div className="guest-wrap">{this.state.guests.map((elem) => (
                <div className="guest-wrap-child">
                    <img src={elem.picture}></img>
                    <span>{elem.status}</span>
                    <p>{elem.name}</p>
                </div>
            
            ))}</div>
            // {options}
         );
        return (<button onClick={this.xd}>xx</button>)
        
    }
}
 
export default GuestList;