import { useState } from 'react'
import ButtonMenu from '../../Elements/Button/ButtonMenu'
import { faMugSaucer, faUtensils, faWhiskeyGlass, faBurger } from '@fortawesome/free-solid-svg-icons'
import MenuCoffee from './MenuCoffee'
import MenuNonCoffee from './MenuNonCoffee'
import MenuLunch from './MenuLunch'
import MenuMore from './MenuMore'

const NavMenu = (props) => {

    const [activeTab, setActiveTab] = useState(0);

    const handleTabClick = (index) => {
        setActiveTab(index);
    };
    return (
        <>
            <nav className="nav-menu" data-aos="fade-up" data-aos-delay="300">
                <ul>
                    <li><ButtonMenu onclick={() => handleTabClick(0)} change={activeTab === 0 ? 'active' : ''} nama="Coffee" icon={faMugSaucer} /></li>
                    <li><ButtonMenu onclick={() => handleTabClick(1)} change={activeTab === 1 ? 'active' : ''} nama="Non Coffee" icon={faWhiskeyGlass} /></li>
                    <li><ButtonMenu onclick={() => handleTabClick(2)} change={activeTab === 2 ? 'active' : ''} nama="Lunch" icon={faBurger} /></li>
                    <li><ButtonMenu onclick={() => handleTabClick(3)} change={activeTab === 3 ? 'active' : ''} nama="More" icon={faUtensils} /></li>
                </ul>
            </nav>

            {activeTab === 0 && (
                <MenuCoffee />
            )}
            {activeTab === 1 && (
                <MenuNonCoffee />
            )}
            {activeTab === 2 && (
                <MenuLunch />
            )}
            {activeTab === 3 && (
                <MenuMore />
            )}

        </>
    )
}

export default NavMenu;