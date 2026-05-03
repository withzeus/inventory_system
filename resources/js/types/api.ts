type Product = {
    id: string;
    name : string;
    stock : number;
    price : number
}

type Order = {
    id : string;
    user_id : string;
    total_price : string;
    user : {
        name : string;
        email : string
    }
}
