
const ImageMenu = (props) => {

    const { index, image, alt, name, price } = props;
    const delay = index * 100;

    return (

        <div className="col-menu" data-aos="fade-up"
            data-aos-delay={delay}>
            <div className="card-menu">
                <div className='overlay-card'></div>
                <img src={image} alt={alt} />
                <span>{name}</span>
                <div className="card-harga">{price}K</div>
            </div>
        </div>
    )
}


export default ImageMenu;