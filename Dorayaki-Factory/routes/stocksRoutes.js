import express from "express";
import {
    getAllBahanBaku,
    tambahBahanBaku,
    updateStok
} from '../controllers/stok.js'

const router = express.Router();

router.get('/', getAllBahanBaku);
router.post('/add', tambahBahanBaku);
router.post('/updateStok', updateStok);
export default router;