import React, { useState } from 'react';
import axios from 'axios';
import styles from '../components/app.module.css';
import Service from "./Service.jsx";

function Formcaisse() {
    const [nom, setNom] = useState('');
    const [prenom, setPrenom] = useState('');
    const [tel, setTel] = useState('');
    const [email, setEmail] = useState('');

    const submit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('nom', nom);
        formData.append('prenom', prenom);
        formData.append('tel', tel);
        formData.append('email', email);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await axios.post('/reserve-Caisse', formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            console.log('Form submitted successfully', response.data);
            window.location.href = 'http://localhost:8000/simulate';

        } catch (error) {
            console.error('Form submission error:', error);
        }
    };

    return (
        <div className={styles.container}>
            <div className={styles.text}>
                Contact us Form
            </div>
            <form onSubmit={submit}>
                <div className={styles.formrow}>
                    <div className={styles.inputdata}>
                        <input
                            value={nom}
                            onChange={(e) => setNom(e.target.value)}
                            type="text"
                            required
                        />
                        <div className={styles.underline}></div>
                        <label htmlFor="">Nom</label>
                    </div>
                    <div className={styles.inputdata}>
                        <input

                            value={prenom}
                            onChange={(e) => setPrenom(e.target.value)}
                            type="text"
                            required
                        />
                        <div className={styles.underline}></div>
                        <label htmlFor="">Prenom</label>
                    </div>
                </div>
                <div className={styles.formrow}>
                    <div  className={styles.inputdata}>
                        <input

                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            type="email"
                        />
                        <div className={styles.underline}></div>
                        <label htmlFor=""> Adresse Email</label>
                    </div>
                    <div className={styles.inputdata}>
                        <input


                            value={tel}
                            onChange={(e) => setTel(e.target.value)}
                            type="tel"
                            required/>
                        <div className={styles.underline}></div>
                        <label htmlFor="">Telphone</label>
                    </div>
                </div>
                <button type="submit">
                    SEND
                </button>
            </form>
        </div>



    );
}export default Formcaisse;