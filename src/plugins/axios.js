import axios from 'axios';
const baseURL = 'https://planttree.ps/api'
// const baseURL =process.env.URL || `${window.location.protocol}//${window.location.host}/api`;
export default axios.create({
    baseURL,
    headers:{
        'Content-Type':'application/json',
    }
});
