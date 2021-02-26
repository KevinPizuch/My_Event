import React, { Component } from 'react'
import { GoogleMap, LoadScript } from '@react-google-maps/api'
import { Marker } from '@react-google-maps/api';

class Maps extends Component {
    constructor(props) {
        super(props);
        this.state = {  }
    }
    render() { 
        return ( 
            <LoadScript
                id="script-loader"
                googleMapsApiKey="AIzaSyBI34oC2fKXoG5Sz4wWvtoY60EScCtPVzE"
            >
                <GoogleMap
                    {...this.props}
                    id="circle-example"
                    mapContainerStyle={{
                        height: "500px",
                        width: "1200px"
                    }}
                    zoom={18}
                    center={{
                        lat : this.props.lat,
                        lng : this.props.lng
                    }}
                >
                    <Marker
                        position={{
                            lat : this.props.lat,
                            lng : this.props.lng
                        }}
                    />
            </GoogleMap>
        </LoadScript>
         );
    }
}
 
export default Maps;