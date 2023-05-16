import axios from 'axios';

export const http = axios.create({
    headers: {
        'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content')
    }
});
