import express from "express";
import {
    verify
} from '../controllers/login'

const router = express.Router();

router.get('/login', verify);
export default router;