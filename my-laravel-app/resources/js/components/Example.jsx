import React from 'react';
import styles from '../components/app.module.css'; // Update the path as needed
import { Button } from 'react-bootstrap';


    function Example() {
        const redirectToOtherView = () => {
            window.location.href = '/service'; // Navigate to the Laravel Blade view URL
        };
    return (

            <div>
                <div className={styles.block}>
            <h1 className={styles.titre}>Central BANK</h1>
            <Button className={styles.button} onClick={redirectToOtherView} ><span className="text">Reservez par ici</span></Button>
                </div>
            </div>


            );
}

export default Example;
