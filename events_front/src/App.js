import React, { Component } from 'react';
import './App.css';
import Home from './Components/Home'
class App extends(Component) {
  state={
    location : 'home',
  }
  render(){


    if(this.state.location === 'home'){
      return (
          <Home />
      )
    }
  }
}

export default App;
