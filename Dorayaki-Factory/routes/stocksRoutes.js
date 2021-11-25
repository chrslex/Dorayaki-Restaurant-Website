import express from "express";
import {
    getAllBahanBaku,
    tambahBahanBaku,
    updateStok,
    getBahanBakuByNama
} from '../controllers/stok.js'

const router = express.Router();

router.get('/', getAllBahanBaku);
router.get('/:nama_bahan_baku', getBahanBakuByNama);
router.post('/add', tambahBahanBaku);
router.post('/updateStok', updateStok);
export default router;