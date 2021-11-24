import express from "express";
import {
    getAllRequest,
    acceptRequest,
    declineRequest
} from "../controllers/request.js";

const router = express.Router();

router.get('/', getAllRequest);
router.patch('/acc/:id/:nama_varian', acceptRequest);
router.patch('/dec/:id', declineRequest);

export default router;