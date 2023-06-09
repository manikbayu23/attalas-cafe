import CardContact from "../../Elements/Cards/CardContact"
import { faPhone, faLocationDot } from "@fortawesome/free-solid-svg-icons";
const GridContact = () => {
    return (
        <div className="contact-content">
            <div className="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.262593647832!2d115.34793367516644!3d-8.276642183203835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1f579afd7161f%3A0xc4036299583a290a!2sAttalas!5e0!3m2!1sid!2sid!4v1686276958956!5m2!1sid!2sid" width="100%" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            <div className="card">
                <CardContact text="08888888888888" icon={faPhone} />
                <CardContact text="Jl. Raya Penelokan, Batur Tengah, Kec. Kintamani, Kabupaten Bangli, Bali" icon={faLocationDot} />
            </div>
        </div>
    )
}
export default GridContact;
