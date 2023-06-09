import RowMenu from "./RowMenu"
import ImageMenu from '../../Elements/Images/ImageMenu';
import kopi2 from '../../../assets/images/kopi-2.png'

const MenuCoffee = () => {
    return (
        <RowMenu>
            <ImageMenu image={kopi2} alt="Gambar Kopi" name="Latte" price="30" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
            <ImageMenu image={kopi2} alt="Gambar Kopi" />
        </RowMenu>
    )
}
export default MenuCoffee;